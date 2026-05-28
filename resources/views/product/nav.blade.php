 <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">
                Laravel CRUD
            </a>

            <div>

                <a href="{{ route('product.index') }}" class="btn btn-outline-light me-2">
                    Products
                </a>
                @if(auth()->user()->role=='admin')
                <a href="{{ route('categories.store') }}" class="btn btn-outline-info-light me-2">
                    Categories
                </a>
                @endif
                @if(auth()->user()->role=='admin')

                <a href="{{ route('product.create') }}" class="btn btn-outline-info-light me-2">
                    Add Product
                </a>

                @endif

                <a href="{{ url('/contact') }}" class="btn btn-outline-light me-2">Contact</a>
                {{-- > --}}


                <a href="{{ route('profile.edit') }}" class="btn btn-outline-light me-2">
                    Edit Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <button type="submit">

                        Logout

                    </button>

                </form>


            </div>

        </div>
    </nav>