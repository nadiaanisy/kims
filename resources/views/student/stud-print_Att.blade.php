 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KI Attendance of {{$profile->id}}</title>
    <style>
          table {
            border-collapse: collapse;
            width: 100%;
            counter-reset: tableCount; 
          }
          td, th {
            border: solid 2px;
            padding: 10px 5px;
          }
          tr {
            text-align: center;
          }
          .container {
            width: 100%;
            text-align: center;
          }
        .counterCell:before {              
            content: counter(tableCount); 
            counter-increment: tableCount; 
        }
    </style>
  </head>
  <body>
    <div class="container">
        <!--<img src="img/logouitm.png" class="user-image img-responsive img"/>-->
        <div>
            <h2>Student Details</h2>
            <p>Name : {{$profile->name}}</p>
            <p>Matric No : {{$profile->id}}</p>
            <p>Code Program : {{$profile->cprog}}</p>
            <hr>
        </div>
        <div>
            <h3>Attendance Details</h3>
        </div>
        @if(!empty($data))
        <table id="example2" role="grid">
            <thead>
                <tr role="row">
                    <th rowspan="2" width="5%">#</th>
                    <th rowspan="2" width="60%">Module Name</th>
                    <th rowspan="2" width="10%">Session</th>
                    <th colspan="3" width="50%">Completion Details</th>        
                </tr>
                <tr>
                    <th width="25%">Date/Time</th>
                    <th width="25%">Status</th>
                    <th width="25%">Remark</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr role="row" class="odd">
                      <td class="counterCell"></td>
                      <td>{{ $d->modname }}</td>
                      <td>{{ $d->smsession }}</td>
                      <td>{{ $d->time }}</td>
                        @if($d->status == '')
                            <td><font color="red">DID NOT ATTEND</td>
                        @else
                            <td><font color="blue">{{ $d->status }}</td>
                        @endif
                        @if($d->remark == "")
                            <td>-</td>
                        @else
                            <td>{{ $d->remark }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        <br>
        <footer class="footer text-right">
                All Rights Reserved by UITMJ. Designed and Developed by NNI.
                Printed on {{ date('Y-m-d H:i:s') }}
        </footer>
    </div>
  </body>
</html>