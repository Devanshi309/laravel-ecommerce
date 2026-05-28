<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-primary text-white text-center">
                    <h3>Contact Us</h3>
                </div>

                <div class="card-body">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                   <form action="{{ route('feedback.store') }}" method="POST">

                        @csrf
                
                        <!-- Name -->
                     <div class="mb-3">

                    <label class="form-label">Name</label>

                    <input type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror

                    </div>

                        <!-- Email -->
                    <div class="mb-3">

                        <label>Email</label>

                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror">

                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        </div>

                        <!-- Message -->
                       <div class="mb-3">

                        <label>Message</label>

                        <textarea name="message"
                        class="form-control @error('message') is-invalid @enderror"
                        rows="4">{{ old('message') }}</textarea>

                        @error('message')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror

                        </div>
                        <!-- CAPTCHA -->
                        <div class="mb-3"> <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"> </div> </div>
                         @error('g-recaptcha-response')

                        <div class="text-danger mt-2">

                        {{ $message }}

                        </div>

                        @enderror
                        <!-- Button -->
                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-primary">
                                Send Message
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>