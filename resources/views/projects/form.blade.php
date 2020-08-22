<form method="POST" action="{{ $action }}">
    @csrf

    <div>
        <label for="name">Nom</label>
        <input type="text" name="name" id="name" value="{{ $project->name ?? '' }}"/>
    </div>
    <div>
        <label for="responsible">Adresse e-mail de contact</label>
        <input type="email" name="email" id="email" value="{{ $project->email ?? ''  }}"/>
    </div>
    <div>
        <label for="phone">Téléphone de contact</label>
        <input type="tel" name="phone" id="phone" value="{{ $project->phone ?? '' }}"/>
    </div>

    <input type="submit" class="button button__secondary" value="{{ $submit }}"/>
</form>
