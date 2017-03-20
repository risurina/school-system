<tbody>
  @if ($school_year)
    @foreach ($school_year->levels as $lvl)
      <tr>
        <td class="project-status">
          <span class="label label-info">{{ $school_year->year }}</span>
        </td>

        <td class="project-title">
          <strong class="text-navy">{{ $lvl->name }}</strong>
        </td>

        <td class="project-title">
          @if (count($lvl->sections))
            @foreach($lvl->sections as $secCount => $section)
              *
              <strong>{{ $section->section }}</strong> | 
              <strong>{{ date('h:i A',strtotime($section->schedule)) }}</strong> |
              <strong>
                {{ $section->employee->fullName() }}
              </strong>
              &nbsp;
              <a onClick="secUpdateModal('{{ $school_year->year }}','{{ $lvl->name }}',{{ $section }})">
                <i class="fa fa-edit text-warning"></i>
              </a>
              <br>
            @endforeach
          @else
            No section!
          @endif
        </td>

        <td class="project-action">
          <a class="btn btn-sm btn-white pull-right" 
              onClick="lvlUpdateModal(
                  {{ json_encode( [ "year" => $school_year->year,"level" => $lvl ] ) }}
              )">Edit </a>
          <a class="pull-right">&nbsp;</a>
          <a class="btn btn-sm btn-white pull-right"
              onClick="secCreateModal(
                  {{ json_encode( [ "year" => $school_year->year,"level" => $lvl ] ) }}
              )">Add Section</a>
        </td>
      </tr>
    @endforeach
  @endif

  @if (!$school_year->levels()->count())
  <tr>
      <td class="text-center" colspan="5">
          No level!
      </td>
  </tr>
  @endif
</tbody>