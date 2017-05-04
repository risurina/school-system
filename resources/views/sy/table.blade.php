
<tbody>
  @if ($schoolYears->count())
    @foreach ($schoolYears as $sy_count => $sy)
    <tr>
        <td class="project-status text-center">
          <span class="label label-primary">{{ $sy->year}}</span>
        </td>

        <td>
          Code : <strong>{{ $sy->code }}</strong>
        <br>
          <small>
          Period : <strong>{{ $sy->displayStartDate() }}</strong>
                to <strong>{{ $sy->displayEndDate() }}</strong>
          </small>
        </td>

        <td>
          <strong>Grading Period</strong>
          <br>
          <small>
            1st : <strong>{{ $sy->firstGrading }}</strong> | 
            2nd : <strong>{{ $sy->secondGrading }}</strong> 
            <br>
            3rd : <strong>{{ $sy->thirdGrading }}</strong> | 
            4th : <strong>{{ $sy->fourthGrading }}</strong> 
          </small>
        </td>

        <td>
          <strong>Monthly Exam & Due</strong>
          <br>
          <small>
            Exam : {{ $sy->monthlyExam }}th <br>
            Due : {{ $sy->monthlyDue }}th
          </small>  
        </td>

        <td class="text-center project-action">
          <a class="btn btn-info btn-flat btn-sm" href="{{ route("sy.profile",[ 'year' => $sy->year ]) }}">View</a>
        </td>
    </tr>
    @endforeach
  @endif

  @if (!$schoolYears->count())
  <tr>
      <td class="text-center" colspan="5">
          No result!
      </td>
  </tr>
  @endif

  @if ($schoolYears->count())
    <tr id="tbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="pagination_row">
          <div id="table_info">
            <p class="pull-left" style="margin-top: 7px;">
              Showing  {{ $schoolYears->firstItem() }} 
              to  {{ $schoolYears->lastItem() }} 
              of  {{ $schoolYears->total() }} 
              entries.
            </p>
          </div>
          <div class="table_pagination">
            {{ $schoolYears->render() }}
          </div>        
        </div>
      </td>
    </tr>
  @endif
</tbody>