
<tbody>

  @if ($ids->count())
    @foreach ($ids as $id_count => $id)
    <tr>
        <td>
          <span class="label label-{{ ($id->type == 'STUDENT') ? 'primary' : 'warning' }}">
              {{ $id->type }}
            </span>  
        </td>
        <td class="project-title">
          <a>{{ $id->fullName }}</a>
          
          @if($id->address || $id->address_two)
          <br>
          <small>{{ $id->address }} | {{ $id->address_two }}</small>
          @endif
        </td>

        <td class="project-people">
          <img src="{{ url('/storage/profile/' . $id->school->code . '/'. $id->year_level . '/' . $id->id . '.jpg') }}"
                class="pull-left"
                alt="Pic"">
        </td>

        <td class="project-title">
          {{ ($id->lrn) ? $id->lrn : '--' }}
        </td>

        <td class="project-title">
          @if($id->type == "STUDENT")
            <strong>Level</strong> : {{ $id->year_level }}
            <br>
            <strong>Section</strong> : {{ $id->section }}
          @else
            <strong>Position</strong> : {{ $id->year_level }}
          @endif
        </td>

        <td class="project-title">
          @if($id->type == "STUDENT")
            <strong>Student ID No</strong> : {{ $id->student_id_no }}
            <br>
            <strong>RFID #</strong> : {{ $id->card_id_no }}
          @endif
        </td>

        <td class="text-navy">{{ $id->phone_number }}</td>

        <td class="project-action">
          <a class="label label-default"
              onClick="uploadImageModal( {{ $id->id }} )">
              Upload
          </a>
          <span>&nbsp;</span>
          <a class="label label-default" onClick="idUpdateModal({{ $id }})">Edit </a>
        </td>
    </tr>
    @endforeach
  @endif

  @if (!$ids->count())
  <tr>
      <td class="text-center" colspan="15">
          No result!
      </td>
  </tr>
  @endif

  @if ($ids->count())
    <tr id="tbl_paginate_row">
      <td class="text-center" colspan="5">
        <div id="pagination_row">
          <div id="table_info">
            <p class="pull-left" style="margin-top: 7px;">
              Showing  {{ $ids->firstItem() }}
              to  {{ $ids->lastItem() }}
              of  {{ $ids->total() }}
              entries.
            </p>
          </div>
          <div class="table_pagination">
            {{ $ids->render() }}
          </div>
        </div>
      </td>
    </tr>
  @endif
</tbody>