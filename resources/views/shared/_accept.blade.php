@can ('accept', $model)
    <a href="#" title="Mark this answer as best answer" 
        class="mt-2 {{ $model->status }}"
        onClick="event.preventDefault();document.getElementById('accept-answer-{{ $model->id }}').submit();">
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form action="{{ route('answers.accept', $model->id)}}" method="post" id="accept-answer-{{ $model->id }}">
        @csrf
    </form>
@else
    @if ($model->is_best)
    <a href="#" title="The answer owner accepted this answer as best answer" class="mt-2 {{ $model->status }}">
        <i class="fas fa-check fa-2x"></i>
    </a>
    @endif

@endcan
