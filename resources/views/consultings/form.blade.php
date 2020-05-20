<form method="POST" action="{{ $action }}">
    @csrf

    <div>
        <label for="consulting_name">Nom de la société</label>
        <input type="text" name="consulting_name" id="consulting_name" value="{{ $consulting->name ?? '' }}"/>
    </div>
    <div>
        <label for="responsible_name">Nom du responsable</label>
        <input type="text" name="responsible_name" id="responsible_name" value="{{ $consulting->responsible ?? ''  }}"/>
    </div>
    <div>
        <label for="phone">Téléphone de contact</label>
        <input type="tel" name="phone" id="phone" value="{{ $consulting->phone ?? '' }}"/>
    </div>
    <div>
        <label for="email">Adresse mail de contact</label>
        <input type="email" name="email" id="email" value="{{ $consulting->email ?? ''  }}"/>
    </div>

    @isset($method)
        @method($method)
    @endif

    @foreach($categories as $category)
        <div>
        <h3>{{ $category->name }}</h3>
        @foreach($category->skills as $skill)
            <input id="skill-{{ $skill->id }}" name="skills[]" type="checkbox">
            <label for="skill-{{ $skill->id }}">{{ $skill->name }}</label>
        @endforeach
            <div>
                <label for="specification-{{ $category->id }}">Précisions</label>
                <textarea id="specification-{{ $category->id }}" name="specification-{{ $category->id }}"></textarea>
            </div>
        </div>
    @endforeach
    <input type="submit" class="button button__secondary" value="{{ $submit }}"/>
</form>
