<tbody>
    @if ($fees)
        @foreach($fees as $feeCount => $fee)
            <tr>
                <td class="text-center">{{ $feeCount + 1 }}</td>
                <td>{{ $fee->code }}</td>
                <td class="">
                    <span class="label label-primary">{{ $fee->fee }}</span>
                </td>
                <td class="text-right text-center">
                  @if($fee->isDefault)
                    <i class="fa fa-check text-navy"></i>
                  @else
                    <i class="fa fa-times text-muted"></i>
                  @endif
                </td>
                <td class="text-right">{{ number_format($fee->amount,2,'.',',') }}</td>
                <td class="text-center">
                    <a onClick="feeUpdateModal({{ $fee }})">Edit</a>
                </td>
            </tr>
        @endforeach
    @endif

  @if (!$fees->count())
    <tr>
        <td class="text-center" colspan="5">
            No fee!
        </td>
    </tr>
  @endif

  @if ($fees->count())
    <tr id="feeTbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="feePagination_row">
          <div class="row">
              <div class="col-lg-6">
                <div id="table_info">
                  <p>
                    Showing  {{ $fees->firstItem() }} 
                    to  {{ $fees->lastItem() }} 
                    of  {{ $fees->total() }} 
                    entries.
                  </p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="feeTable_pagination">
                  {{ $fees->render() }}
                </div>
              </div>
          </div>
        </div>
      </td>
    </tr>
  @endif
</tbody>