@foreach($questions as $question)
    <tr>
        <th>Current</th>
        <td hidden>{{encrypt($question->id)}}</td>
        <td hidden>{{encrypt($question->parent_id)}}</td>
        <td>{{$question->questionCategory}}<span> {{$question->subject}}</span></td>
        <td>{{trim($question->info)}}</td>
        <td>
            <a href="{{$question->link1}}" target="_blank">
                {{$question->link1}}
            </a>
        </td>
        <td>
            <a {{$question->link2!='null'?'href="'.$question->link2.'" target="_blank"':'href="#"'}}>
                {{$question->link2!='null'? $question->link2 : '-'}}
            </a>
        </td>
        <td>
            <label class="btn btn-primary active edit_row_btn">
                <span class="glyphicon glyphicon-ok"></span>
            </label>
        </td>
    </tr>
@endforeach