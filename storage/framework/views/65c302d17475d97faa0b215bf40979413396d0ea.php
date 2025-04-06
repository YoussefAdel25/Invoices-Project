<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - مورا سوفت</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-sm w-full text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">مرحبًا بك مجددًا! 👋</h2>
        <p class="text-gray-500 mb-6">تسجيل الدخول للوصول إلى حسابك</p>
        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <input type="email" name="email" placeholder="البريد الإلكتروني" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <input type="password" name="password" placeholder="كلمة المرور" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex justify-between items-center text-sm text-gray-500">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2"> تذكرني
                </label>
                <a href="#" class="text-indigo-500 hover:underline">نسيت كلمة المرور؟</a>
            </div>
            <button class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">تسجيل الدخول</button>
        </form>
        <p class="mt-4 text-gray-500 text-sm">ليس لديك حساب؟ <a href="#" class="text-indigo-500 hover:underline">إنشاء حساب</a></p>
    </div>
</body>
</html>
<?php /**PATH E:\invoices\resources\views/auth/login.blade.php ENDPATH**/ ?>