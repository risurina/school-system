
<tbody>
  
  @if ($students->count())
    @foreach ($students as $student_count => $student)
    <tr>
        <td>{{ $student_count + 1 }}</td>
        <td>{{ $student->id }}</td>
        <td class="text-navy">{{ $student->lrnNo }}</td>
        <td class="client-avatar text-center" >
            <img alt="Pic" 
                 src="{{ url("/public/storage/profile/student/2017/" . $student->id  .".jpg") }}" 
                 style="margin: -5px; padding: -5px;">
        </td>
        <td>{{ $student->fullName }} {{ $student->currentProgress()['year'] }}</td>
        <th class="text-center {{ ($student->sex == 'M') ? 'text-info' : 'text-danger' }}" >
          {{ $student->sex }}
        </th>
        <td class="text-center">
          <a href="{{ route('student.profile',['id'=> $student->id ]) }}">View </a>
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