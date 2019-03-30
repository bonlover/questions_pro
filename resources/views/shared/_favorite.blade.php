<a href="#" title="Click to mark as favorite question (Click again to undo)"
    class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '')}}"
    onClick="event.preventDefault();document.getElementById('favorite-question-{{ $model->id }}').submit();">
    <i class="fas fa-star fa-2x"></i>
</a>
<span class="favorites-count">{{ $model->favorites_count }}</span>
<form action="/questions/{{ $model->id }}/favorites" method="post" id="favorite-question-{{ $model->id }}">
    @csrf
    @if ($model->is_favorited)
        @method('DELETE')
    @endif
</form>