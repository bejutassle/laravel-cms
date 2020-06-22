<html>
<head>
    <style>
        p {
            font-size: 16px;
            color: #000;
        }
    </style>
</head>
<body>
<p>{{ trans('updates.registermail',  ['UserName' => $username, 'ActivateLink' => $activeurl ]) }}
</p>
</body>
</html>