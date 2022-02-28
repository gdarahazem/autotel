<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Promed')
{{--<img src="{{asset("images/logo/".$logo)}}" class="logo" alt="Laravel Logo">--}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
