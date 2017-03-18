
<tbody>
  @if ($employees->count())
    @foreach ($employees as $count => $emp)
    <tr>
        <td>{{ ($count + 1) }}</td>

        <td> <strong>{{ $emp->fullName() }}</strong> </td>

        <td> {{ $emp->position }} </td>

        <td> {{ number_format($emp->takeHome,2,'.',',') }} </td>

        <td> <span class="label label-primary">{{ $emp->status }}</span> </td>

        <td>
          @if ($emp->isActive)
            <i class="fa fa-check text-navy"></i>
          @else
            <i class="fa fa-times text-mute"></i>
          @endif
        </td>

        <td class="text-center project-action">
          <a onClick="empUpdateModal({{ $emp }})">Edit </a>
        </td>
    </tr>
    @endforeach
  @endif

  @if (!$employees->count())
  <tr>
      <td class="text-center" colspan="10">
          No result!
      </td>
  </tr>
  @endif

  @if ($employees->count())
    <tr id="tbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="pagination_row">
          <div id="table_info">
            <p class="pull-left" style="margin-top: 7px;">
              Showing  {{ $employees->firstItem() }} 
              to  {{ $employees->lastItem() }} 
              of  {{ $employees->total() }} 
              entries.
            </p>
          </div>
          <div class="table_pagination">
            {{ $employees->render() }}
          </div>        
        </div>
      </td>
    </tr>
  @endif
</tbody>