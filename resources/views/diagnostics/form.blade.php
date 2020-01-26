<form method="POST" action="{{ $action }}">
    @csrf

    @isset($method)
    @method($method)
    @endif

    <div class="flex flex-col lg:flex-row lg:-mx-4 flex-grow-0 flex-wrap">
        @forelse($categories as $category)
            <div class="lg:mx-4 flex-1 mb-6">
                <h3 class="mb-2 center">{{ $category->name }}</h3>
                <div class="flex -mx-2 flex-wrap justify-between">
                    @forelse($category->needs as $need)
                        <input id="need-{{ $need->id }}" value="{{ $need->id }}" class="need-item-checkbox"
                               type="checkbox"
                               name="needs[]" hidden/>
                        <label for="need-{{ $need->id }}">
                            {{ $need->name }}
                        </label>
                    @empty
                        <p>Cette catégorie ne possède actuellement aucun besoin</p>
                    @endforelse
                </div>
            </div>
        @empty
            Il n'y a actuellement aucune catégories de besoin
        @endforelse
    </div>

    <input type="submit" class="button button-secondary" value="{{ $submit }}"/>
</form>
