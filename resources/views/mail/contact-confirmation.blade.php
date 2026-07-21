@php
    use Illuminate\Support\Facades\App;
    App::setLocale($submissionLocale);

    $typeLabel = trans('contact.request_types.' . $data['request_type'])
        ?? $data['request_type'];
@endphp
<!DOCTYPE html>
<html lang="{{ $submissionLocale }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ trans('contact.confirm_subject') }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #222; background: #f5f5f2; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 32px auto; background: #fff; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #2c1a0e; color: #fff; padding: 24px 32px; }
        .header h1 { margin: 0; font-size: 18px; font-weight: 600; letter-spacing: .02em; }
        .header p { margin: 4px 0 0; font-size: 13px; color: rgba(255,255,255,.65); }
        .body { padding: 28px 32px; line-height: 1.55; }
        .body p { margin: 0 0 16px; }
        .summary { background: #f5f5f2; border-radius: 6px; padding: 16px 20px; margin: 0 0 20px; }
        .summary p { margin: 0 0 10px; }
        .summary p:last-child { margin-bottom: 0; }
        .summary strong { color: #7a6a5a; }
        .message-text { white-space: pre-wrap; }
        .footer { padding: 16px 32px; background: #f5f5f2; font-size: 12px; color: #9a8878; text-align: center; border-top: 1px solid #ece8e3; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>{{ config('site.name') }}</h1>
        <p>{{ trans('contact.confirm_subject') }}</p>
    </div>

    <div class="body">
        <p>{{ trans('contact.confirm_greeting', ['name' => $data['name']]) }}</p>

        <p>{{ trans('contact.confirm_intro') }}</p>

        <div class="summary">
            <p><strong>{{ trans('contact.confirm_type_label') }}:</strong> {{ $typeLabel }}</p>
            <p><strong>{{ trans('contact.confirm_message_label') }}:</strong><br>
                <span class="message-text">{{ $data['message'] }}</span></p>
        </div>

        <p>
            {{ trans('contact.confirm_signoff') }}<br>
            {{ config('site.name') }}
        </p>
    </div>

    <div class="footer">
        {{ trans('contact.confirm_auto_notice') }}
    </div>

</div>
</body>
</html>
