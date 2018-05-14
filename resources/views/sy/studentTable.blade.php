
<tbody>
  
  @if ($students->count())
    @foreach ($students as $student_count => $student)
    <tr>
        <td class="text-center">{{ $student_count + 1 }} - {{ $student->id }}</td>
        <td class="client-avatar text-center" >
            <img alt="Pic" 
                 src="{{ url("/public/storage/profile/student/".$student->year."/" . $student->student_id  .".jpg") }}" 
                 style="margin: -5px; padding: -5px;">
        </td> 
        <td>{{ $student->student->fullName }}</td>
        <td class="text-left"> {{ $student->level }} - {{ $student->section }}</td>
        <td class="text-center">{{ ($student->isCash) ? 'CASH' : 'INSTALLMENT' }}</td>
        <td class="text-right">{{ number_format( $student->total_fee, 2, '.', ',') }}</td>
        <td class="text-right">{{ number_format( $student->total_payment, 2, '.', ',') }}</td>
        <td class="text-right">
          @if( $student->total_balance <= 0 )
            <span class="label label-primary">PAID</span>
          @else
            <span>{{ number_format( $student->total_balance, 2, '.', ',') }}</span>
          @endif
        </td>
        <td class="text-center">
          <a class="label label-default"
              id="addIDprintQry_{{ $student->id }}"
              onClick="addIDprintQry( {{ $student->id }} )">
              ID
          </a>
          <a href="">&nbsp;</a>
          <a class="label label-default"
              onClick="uploadImageModal( {{ $student->id }} )">
              Upload
          </a>
          <a href="">&nbsp;</a>
          <a onClick="printSOA('{{ $student->student_id }}')"
             class="label label-default">
            Print SOA 
          </a>
          <a href="">&nbsp;</a>

          <a href="{{ route('student.profile',['id'=> $student->student_id, 'sy'=>$student->year ]) }}"
             class="label label-default">
            View 
          </a>
        </td>
    </tr>
    @endforeach
  @endif

  @if (!$students->count())
  <tr>
      <td class="text-center" colspan="15">
          No result!
      </td>
  </tr>
  @endif

  @if ($students->count())
    <tr id="tbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="pagination_row">
          <div id="table_info">
            <p class="pull-left" style="margin-top: 7px;">
              Showing  {{ $students->firstItem() }} 
              to  {{ $students->lastItem() }} 
              of  {{ $students->total() }} 
              entries.
            </p>
          </div>
          <div class="table_pagination">
            {{ $students->render() }}
          </div>        
        </div>
      </td>
    </tr>
  @endif
</tbody>