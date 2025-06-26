<x-layout>
    <div class="d-flex justify-content-center align-items-center" style="min-height: 80vh; background-color: #fdfaf6;">
        <div class="card shadow" style="min-width: 350px; max-width: 400px; width: 100%; border: none;">
            <div class="p-4">
                <h3 class="mb-4 text-center fw-bold" style="color: #8B2F2B; font-family: 'Cinzel', serif;">
                    Register
                </h3>

                @if(session('errorMessage'))
                    <div class="alert alert-danger">
                        {{ session('errorMessage') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('customer.store_register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label text-muted">Name</label>
                        <input  
                            type="text"  
                            class="form-control rounded-3 border-dark-subtle @error('name') is-invalid @enderror"   
                            id="name"  
                            name="name"   
                            value="{{ old('name') }}"  
                            required autofocus>
                        @error('name') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror 
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-muted">Email address</label>
                        <input  
                            type="email"  
                            class="form-control rounded-3 border-dark-subtle @error('email') is-invalid @enderror"  
                            id="email"  
                            value="{{ old('email') }}"  
                            required 
                            name="email">
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
                            required 
                            name="password">
                        @error('password') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror 
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-muted">Confirm Password</label>
                        <input  
                            type="password"  
                            class="form-control rounded-3 border-dark-subtle @error('password_confirmation') is-invalid @enderror"    
                            id="password_confirmation"  
                            required  
                            name="password_confirmation">
                        @error('password_confirmation') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                        @enderror 
                    </div>

                    <button type="submit" class="btn w-100 text-white fw-bold" style="background-color: #8B2F2B;">
                        Register
                    </button>
                </form>

                <div class="mt-3 text-center">
                    <small class="text-muted">
                        Sudah memiliki akun?
                        <a href="{{ route('customer.login') }}" style="color: #d4af37;">Login</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</x-layout>