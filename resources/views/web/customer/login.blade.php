<x-layout>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh; background-color: #fdfaf6;">
        <div class="card shadow" style="min-width: 350px; max-width: 400px; width: 100%; border: none;">
            <div class="p-4">
                <h3 class="mb-4 text-center fw-bold" style="color: #8B2F2B; font-family: 'Cinzel', serif;">
                    Login
                </h3>

                @if(session('errorMessage'))
                    <div class="alert alert-danger">
                        {{ session('errorMessage') }}
                    </div>
                @endif

                @if(session('successMessage'))
                    <div class="alert alert-success">
                        {{ session('successMessage') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('customer.login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Email address</label>
                        <input
                            type="email"
                            class="form-control rounded-3 border-dark-subtle @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-muted">Password</label>
                        <input
                            type="password"
                            class="form-control rounded-3 border-dark-subtle @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn w-100 text-white fw-bold" style="background-color: #8B2F2B;">
                        Login
                    </button>
                    <div class="mt-3 text-center">
                        <small class="text-muted">
                            Belum punya akun?
                            <a href="{{ route('customer.register') }}" style="color: #d4af37;">Daftar disini</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>