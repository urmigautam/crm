
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Purposal Letter</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    table {
      border: 1px solid;
      border-collapse: collapse;
      width: 100%;
      margin-bottom: 20px;
    }
    th, td {
      border: 1px solid;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #f2f2f2;
    }
    .btn-confirm {
      background: blue;
      color: white;
      border: 1px solid black;
      padding: 15px 30px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
      font-size: 20px; /* Larger font size */
    }
    .left {
      float: left;
    }
    .right {
      float: right;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Purposal Letter</h2>
  <h3>{{$data['company_name']}}</h3>
  <p>Select items by clicking on the link below.</p>            
  <table>
    <thead>
      <tr>
        <th>SERIAL NO</th>
        <th>COLLECTION</th>
        <th>ART CODE</th>
        <th>COMPOSITION</th>
        <th>WIDTH</th>
        <th>GR./MT.</th>
       
      </tr>
    </thead>
    <tbody>
      @php($count = 1)
      @foreach($data['itemsDetail'] as $com)
        <tr>
          <td>{{ $count }}</td>
          <td>{{ $com->lead_category }}</td>
          <td>{{ $com->composition }}</td>
          <td>{{ $com->width }}</td>
          <td>{{ $com->grmt }}</td>
          <td>{{ $com->art_code }}</td>
         
        </tr>
        @php($count++)
      @endforeach
    </tbody>
  </table>
</div>

<div>
  <div class="left">
    <h2>Total Price: {{$data['amount']}}</h2>
  </div>
  <div class="right">
    <a class="btn-confirm" href="{{ $data['url'] }}"><span style="color: white; font-weight: bold;">Confirm order</span></a>
  </div>
  <div style="clear: both;"></div>
</div>

</body>
</html>