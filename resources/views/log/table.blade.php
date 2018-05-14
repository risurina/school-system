<tbody>
    @if ($logs)
        @foreach($logs as $logCount => $log)
            <tr>
                <td class="text-center">{{ $logCount + 1 }}</td>
                <td>
                  {{ $log->details()->fullName }}
                </td>

                <td class="">
                      {{ date('M d, Y', strtotime($log->dateTime)) }}
                </td>
                <td class="">
                      {{ date('h:i:s A', strtotime($log->dateTime)) }}
                </td>
            </tr>
        @endforeach
    @endif

  @if (!$logs->count())
    <tr>
        <td class="text-center" colspan="5">
            No Logs!
        </td>
    </tr>
  @endif
</tbody>