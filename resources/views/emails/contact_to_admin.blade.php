Hello Admin,<br><br>
Someone contacts you having data below:<br><br>
<strong>Name: </strong>{{ $data['name'] }}<br>
<strong>Email: </strong>{{ $data['email'] }}<br>
<strong>Subject: </strong>{{ $data['subject'] }}<br>
<strong>Description: </strong>{{ $data['content'] }}<br><br>
Regards,<br>
{{ \App\Config::get_field('site_title') }}