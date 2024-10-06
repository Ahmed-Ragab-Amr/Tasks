<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد المهمة</title>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .form-group {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
        }
        .form-group label {
            margin-top: 10px;
        }
        .btn {
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="card">
            <h1>تأكيد المهمة</h1>

            <!-- إظهار رسالة بناءً على حالة المهمة -->
            @if($task->status == 'canceled')
                <div class="alert error">
                    تم إلغاء هذه المهمة بالفعل.
                </div>
            @else
                <!-- عرض الرسائل العادية لو المهمة مش ملغية -->
                <p>عزيزتي الزبونة، نسعد دائمًا بخدمتك. إذا كنتِ ترغبين في إلغاء الموعد، يرجى الضغط على الزر التالي واختيار زر "إلغاء الموعد".</p>

                <form action="{{ route('client.cancele', $task->uuid) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cancel">هل ترغبين في إلغاء هذه المهمة؟</label>
                        <input type="checkbox" name="cancele" id="cancel">
                    </div>
                    <button type="submit" class="btn btn-primary">إلغاء الموعد</button>
                </form>
            @endif

            <!-- إظهار رسائل النجاح أو الفشل -->
            @if (session('success'))
                <div class="alert success">
                    {{ session('success') }}
                </div>
            @elseif (session('error'))
                <div class="alert error">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</body>
</html>
