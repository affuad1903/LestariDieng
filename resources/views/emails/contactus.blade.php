<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Website</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #4a90e2; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background-color: #f9f9f9; }
        .field { margin-bottom: 15px; }
        .label { font-weight: bold; color: #555; }
        .value { margin-top: 5px; padding: 10px; background-color: white; border-left: 3px solid #4a90e2; }
        .message-content { white-space: pre-wrap; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Baru dari Website Lestari Wisata Dieng</h2>
        </div>
        <div class="content">
            <div class="field">
                <div class="label">Nama:</div>
                <div class="value">{{ $data['contactus_name'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Email:</div>
                <div class="value">{{ $data['contactus_email'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Nomor Telepon:</div>
                <div class="value">{{ $data['contactus_phone'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Subjek:</div>
                <div class="value">{{ $data['contactus_subject'] }}</div>
            </div>
            
            <div class="field">
                <div class="label">Pesan:</div>
                <div class="value message-content">{{ $data['contactus_message'] }}</div>
            </div>
            
            <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
            <p style="color: #666; font-size: 12px;">
                Email ini dikirim otomatis dari sistem kontak website Lestari Wisata Dieng.<br>
                Waktu: {{ now()->format('d F Y H:i:s') }}
            </p>
        </div>
    </div>
</body>
</html>
