<h3><strong>Явагдсан ажиллагаа</strong></h3>
<table class="table" id="operations">
  <thead>
    <tr>
      <th>№</th>
      <th>Улс</th>
      <th>Ээлж</th>
      <th>Явсан өдөр</th>
      <th>Ирсэн өдөр</th>
    </tr>
  </thead>
  <tbody>
    @php $i=1; @endphp
    @foreach($operations as $operation)
      <tr id="row{{$operation->id}}">
        <td>{{$i}}</td>
        <td>{{$operation->countryName}}</td>
        <td>{{$operation->eelj}}</td>
        <td>{{$operation->leaveDate}}</td>
        <td>{{$operation->arriveDate}}</td>
        <td>
          <input type="button" class="btn btn-warning" value="Засах" onclick="editOperation({{$operation->id}}, '{{$operation->country}}', {{$operation->eelj}}, '{{$operation->leaveDate}}', '{{$operation->arriveDate}}')" />
          <input type="button" class="btn btn-danger" value="Устгах" onclick="deleteOperation({{$operation->id}})" />
        </td>
      </tr>
      @php $i++; @endphp
    @endforeach
    <script>lastIndex = {{$i}};</script>
  </tbody>
</table>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOperation">Ажиллагаа нэмэх</button>
