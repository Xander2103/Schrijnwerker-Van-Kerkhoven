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
    <title>{{ trans('contact.email_subject') }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #222; background: #f5f5f2; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 32px auto; background: #fff; border-radius: 6px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .header { background: #2c1a0e; color: #fff; padding: 24px 32px; }
        .header h1 { margin: 0; font-size: 18px; font-weight: 600; letter-spacing: .02em; }
        .header p { margin: 4px 0 0; font-size: 13px; color: rgba(255,255,255,.65); }
        .body { padding: 28px 32px; }
        .greeting { font-size: 15px; color: #444; margin-bottom: 24px; }
        table { width: 100%; border-collapse: collapse; }
        td { padding: 10px 12px; font-size: 14px; vertical-align: top; border-bottom: 1px solid #ece8e3; }
        td:first-child { width: 38%; color: #7a6a5a; font-weight: 600; white-space: nowrap; }
        td:last-child { color: #222; }
        .message-row td:last-child { white-space: pre-wrap; line-height: 1.55; }
        .footer { padding: 16px 32px; background: #f5f5f2; font-size: 12px; color: #9a8878; text-align: center; border-top: 1px solid #ece8e3; }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="header">
        <h1>{{ config('site.name') }}</h1>
        <p>{{ trans('contact.email_subject') }}</p>
    </div>

    <div class="body">
        <p class="greeting">{{ trans('contact.email_greeting') }}</p>

        <table>
            <tr>
                <td>{{ trans('contact.email_lbl_locale') }}</td>
                <td>{{ trans('contact.email_locale_name') }}</td>
            </tr>
            <tr>
                <td>{{ trans('contact.email_lbl_name') }}</td>
                <td>{{ $data['name'] }}</td>
            </tr>
            @if(!empty($data['email']))
            <tr>
                <td>{{ trans('contact.email_lbl_email') }}</td>
                <td><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
            </tr>
            @endif
            @if(!empty($data['phone']))
            <tr>
                <td>{{ trans('contact.email_lbl_phone') }}</td>
                <td><a href="tel:{{ $data['phone'] }}">{{ $data['phone'] }}</a></td>
            </tr>
            @endif
            <tr>
                <td>{{ trans('contact.email_lbl_type') }}</td>
                <td>{{ $typeLabel }}</td>
            </tr>
            <tr class="message-row">
                <td>{{ trans('contact.email_lbl_message') }}</td>
                <td>{{ $data['message'] }}</td>
            </tr>
            <tr>
                <td>{{ trans('contact.email_lbl_consent') }}</td>
                <td>{{ trans('contact.email_consent_yes', ['datetime' => $data['submitted_at']]) }}</td>
            </tr>
            @if(!empty($data['source_url']))
            <tr>
                <td>{{ trans('contact.email_lbl_source') }}</td>
                <td>{{ $data['source_url'] }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="footer">
        {{ config('site.name') }} · {{ config('site.address') }}, {{ config('site.city') }}
    </div>

</div>
</body>
</html>
