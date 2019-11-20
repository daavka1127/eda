
  @php $i=1; @endphp
  @foreach($sectors as $sector)
    <tr id="row{{$sector->id}}">
      <td>{{$i}}</td>
      <td>
        {{$country->countryID}}
      </td>
      <td>
        {{$country->sectorName}}
      </td>
      <td>
        <input type="button" class="btn btn-warning" value="Засах" onclick="editCountry({{$country->id}}, '{{$country->countryName}}')" />
        <input type="button" class="btn btn-danger" value="Устгах" onclick="deleteCountry({{$country->id}})" />
      </td>
    </tr>
    @php $i++; @endphp
  @endforeach
  <script>lastIndex = {{$i}};</script>
