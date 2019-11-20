<h3><strong>Ажиллагааны улс</strong></h3>
<table class="table">
  <thead>
    <tr>
      <th>№</th>
      <th>Улс</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @php $i=1; @endphp
    @foreach($countries as $country)
      <tr id="row{{$country->id}}">
        <td>{{$i}}</td>
        <td id="clCountryName{{$country->id}}">
          {{$country->countryName}}
          <input type="hidden" value="{{$country->countryName}}" id="countryName" />
        </td>
        <td>
          <input type="button" class="btn btn-warning" value="Засах" onclick="editCountry({{$country->id}}, '{{$country->countryName}}')" />
          <input type="button" class="btn btn-danger" value="Устгах" onclick="deleteCountry({{$country->id}})" />
        </td>
      </tr>
      @php $i++; @endphp
    @endforeach
    <script>lastIndex = {{$i}};</script>
  </tbody>
</table>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newCountry">Улс нэмэх</button>
