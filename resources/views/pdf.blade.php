<TABLE border="1" cellspacing="0" cellpadding="5" width='450'>
    <tr>
        <td width='150'>Dates</td>
        <td width='150'>Nom de l'UE</td>
        <td width='150'>Présent</td>
    </tr>
    @foreach ($AllLessons as $lesson)
    <tr>
        <td>début : {{$lesson->begin_at}}  <br> fin : {{$lesson->end_at}}</td>
        <td>{{$lesson->type}} de {{$lesson->unit->name}} : {{$lesson->name}}</td>
        @if(in_array($lesson->id, $PresentLessonsId))
        <td bgcolor="green">
        @else
        <td bgcolor="red">
        @endif
    </tr>
    @endforeach
</TABLE>
