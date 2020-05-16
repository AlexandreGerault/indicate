<form method="POST" action="{{ $action }}">
    @csrf

    @isset($method)
        @method($method)
    @endif

    <div class="form__create__diagnostic">
        @forelse($categories as $category)
            <section class="form__create__diagnostic__need__category">
                <h3>{{ $category->name }}</h3>
                <div class="form__create__diagnostic__need__group">
                    @forelse($category->needs as $need)
                        <input id="need-{{ $need->id }}" value="{{ $need->id }}"
                               class="form__create__diagnostic__need__checkbox"
                               type="checkbox"
                               name="needs[]"/>
                        <label for="need-{{ $need->id }}" class="form__create__diagnostic__need__item">
                            {{ $need->name }}
                        </label>
                    @empty
                        <p>Cette catégorie ne possède actuellement aucun besoin</p>
                    @endforelse
                    <div>
                        <label>Autre (préciser)</label>
                        <textarea id="comment-{{ $category->id }}"
                              name="comment-{{ $category->id }}">@if(($comment = $diagnostic->commentOfCategory($category)) != null){{ $comment->content }}@endisset</textarea>
                    </div>
                </div>
            </section>
        @empty
            Il n'y a actuellement aucune catégories de besoin
        @endforelse
    </div>

    <input type="submit" class="button button__secondary" value="{{ $submit }}"/>
</form>
