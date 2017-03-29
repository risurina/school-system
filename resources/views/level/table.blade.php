<tbody>
    @if ($levels)
        @foreach($levels as $lvlCount => $level)
            <tr>
                <td class="text-center">{{ $lvlCount + 1 }}</td>
                <td>{{ $level->code }}</td>
                <td class="">
                    <span class="label label-primary">{{ $level->level }}</span>
                </td>
                <td class="text-center">
                    <a onClick="lvlUpdateModal({{ $level }})">Edit</a>
                </td>
            </tr>
        @endforeach
    @endif

  @if (!$levels->count())
    <tr>
        <td class="text-center" colspan="5">
            No level!
        </td>
    </tr>
  @endif

  @if ($levels->count())
    <tr id="lvlTbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="lvlPagination_row">
          <div class="row">
              <div class="col-lg-5">
                <div id="table_info">
                  <p>
                    Showing  {{ $levels->firstItem() }} 
                    to  {{ $levels->lastItem() }} 
                    of  {{ $levels->total() }} 
                    entries.
                  </p>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="lvlTable_pagination">
                  {{ $levels->render() }}
                </div>
              </div>
          </div>
        </div>
      </td>
    </tr>
  @endif
</tbody>