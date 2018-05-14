
<tbody>
  @if ($schools->count())
    @foreach ($schools as $school_count => $school)
    <tr>
        <td>{{ $school_count + 1 }}</td>
        <td>{{ $school->code }}</td>
        <td>{{ $school->name }}</td>
        <td>{{ $school->address }}</td>
        <td class="text-center">
          <a onClick='schoolView("{{ $school->id }}")'>View </a> |
          <a onClick="schoolUpdate({{ $school }})">Edit </a> 
          <!--
          <a onClick='schoolDelete("{{ $school->id }}","{{ $school->name }}")'>Delete </a>
          -->
        </td>
    </tr>
    @endforeach
  @endif

  @if (!$schools->count())
  <tr>
      <td class="text-center" colspan="5">
          No result!
      </td>
  </tr>
  @endif

  @if ($schools->count())
    <tr id="tbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="pagination_row">
          <div id="table_info">
            <p class="pull-left" style="margin-top: 7px;">
              Showing  {{ $schools->firstItem() }} 
              to  {{ $schools->lastItem() }} 
              of  {{ $schools->total() }} 
              entries.
            </p>
          </div>
          <div class="table_pagination">
            {{ $schools->render() }}
          </div>        
        </div>
      </td>
    </tr>
  @endif
</tbody>