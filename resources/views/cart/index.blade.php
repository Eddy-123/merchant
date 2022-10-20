@extends('layouts.master')

@section('content')
<!-- https://mdbootstrap.com/docs/standard/extended/shopping-carts/ -->
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-md-12">
                <h5 class="mb-3"><a href="#!" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Panier</p>
                    <p class="mb-0">Vous avez {{ Cart::count() }} éléments dans votre panier.</p>
                  </div>
                  <div>
                    <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!" class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                  </div>
                </div>
                @if (Cart::count() > 0)
                @foreach (Cart::content() as $product)
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                          <img src="{{ $product->model->image }}" class="img-fluid rounded-3" alt="Image du produit" style="width: 65px;">
                        </div>
                        <div class="ms-3">
                          <h5>{{ $product->model->title }}</h5>
                          <p class="small mb-0">Catégorie: </p>
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 50px;">
                          <h5 class="fw-normal mb-0">1</h5>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">{{ $product->model->getPrice() }}</h5>
                        </div>
                        <form action="{{ route('cart.destroy', $product->rowId) }}" method="post">
                          @csrf
                          @method('DELETE')
                          <button type="submit">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                @else
                <p>Votre panier est vide.</p>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('styles')
@media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}
@endpush