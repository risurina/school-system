<tbody>
    @if ($schedules)
        @foreach($schedules as $count => $schedule)
            <tr>
                <td class="text-center">{{ $count + 1 }}</td>
                <td>{{ $schedule->schedule }}</td>
                <td class="">
                    <span class="label label-primary">
                      {{ date('h:i A',strtotime($schedule->startTime)) }}
                    </span>
                    &nbsp;To&nbsp;
                    <span class="label label-primary">
                      {{ date('h:i A',strtotime($schedule->endTime)) }}
                    </span>
                </td>
                <td class="text-center">
                    <a onClick="scheduleUpdateModal({{ $schedule }})">Edit</a>
                </td>
            </tr>
        @endforeach
    @endif

  @if (!$schedules->count())
    <tr>
        <td class="text-center" colspan="5">
            No schedule!
        </td>
    </tr>
  @endif

  @if ($schedules->count())
    <tr id="scheduleTbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="schedulePagination_row">
          <div class="row">
              <div class="col-lg-5">
                <div id="table_info">
                  <p>
                    Showing  {{ $schedules->firstItem() }} 
                    to  {{ $schedules->lastItem() }} 
                    of  {{ $schedules->total() }} 
                    entries.
                  </p>
                </div>
              </div>
              <div class="col-lg-7">
                <div class="scheduleTable_pagination">
                  {{ $schedules->render() }}
                </div>
              </div>
          </div>
        </div>
      </td>
    </tr>
  @endif
</tbody>