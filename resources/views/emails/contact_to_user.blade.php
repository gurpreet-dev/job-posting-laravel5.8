Hello {{ $data['name'] }},<br><br>
Our support team replied to your message. Full detail are as below:<br><br>
<strong>Name: </strong>{{ $data['name'] }}<br>
<strong>Email: </strong>{{ $data['email'] }}<br>
<strong>Subject: </strong>{{ $data['subject'] }}<br>
<strong>Description: </strong>{{ $data['content'] }}<br>
<strong>Reply: </strong>{{ $data['reply'] }}<br><br>
Regards,<br>
{{ \App\Config::get_field('site_title') }}