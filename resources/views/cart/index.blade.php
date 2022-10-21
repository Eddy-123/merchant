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
                          <button type="submit" class="btn btn-outline-dark">
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

            <div class="card shadow-2-strong mb-5 mb-lg-0" style="border-radius: 16px;">
              <div class="card-body p-4">

                <div class="row">
                  <div class="col-md-6 col-lg-4 col-xl-3 mb-4 mb-md-0">
                    <form>
                      <div class="d-flex flex-row pb-3">
                        <div class="d-flex align-items-center pe-2">
                          <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel1v" value="" aria-label="..." checked />
                        </div>
                        <div class="rounded border w-100 p-3">
                          <p class="d-flex align-items-center mb-0">
                            <i class="fab fa-cc-mastercard fa-2x text-dark pe-2"></i>Credit
                            Card
                          </p>
                        </div>
                      </div>
                      <div class="d-flex flex-row pb-3">
                        <div class="d-flex align-items-center pe-2">
                          <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel2v" value="" aria-label="..." />
                        </div>
                        <div class="rounded border w-100 p-3">
                          <p class="d-flex align-items-center mb-0">
                            <i class="fab fa-cc-visa fa-2x fa-lg text-dark pe-2"></i>Debit Card
                          </p>
                        </div>
                      </div>
                      <div class="d-flex flex-row">
                        <div class="d-flex align-items-center pe-2">
                          <input class="form-check-input" type="radio" name="radioNoLabel" id="radioNoLabel3v" value="" aria-label="..." />
                        </div>
                        <div class="rounded border w-100 p-3">
                          <p class="d-flex align-items-center mb-0">
                            <i class="fab fa-cc-paypal fa-2x fa-lg text-dark pe-2"></i>PayPal
                          </p>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-6">
                    <div class="row">
                      <div class="col-12 col-xl-6">
                        <div class="form-outline mb-4 mb-xl-5">
                          <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="John Smith" />
                          <label class="form-label" for="typeName">Name on card</label>
                        </div>

                        <div class="form-outline mb-4 mb-xl-5">
                          <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YY" size="7" id="exp" minlength="7" maxlength="7" />
                          <label class="form-label" for="typeExp">Expiration</label>
                        </div>
                      </div>
                      <div class="col-12 col-xl-6">
                        <div class="form-outline mb-4 mb-xl-5">
                          <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1111 2222 3333 4444" minlength="19" maxlength="19" />
                          <label class="form-label" for="typeText">Card Number</label>
                        </div>

                        <div class="form-outline mb-4 mb-xl-5">
                          <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                          <label class="form-label" for="typeText">Cvv</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xl-3">
                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                      <p class="mb-2">Sous-total</p>
                      <p class="mb-2">{{ getPrice(Cart::subtotal()) }}</p>
                    </div>

                    <div class="d-flex justify-content-between" style="font-weight: 500;">
                      <p class="mb-0">Taxe</p>
                      <p class="mb-0">{{ getPrice(Cart::tax()) }}</p>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-4" style="font-weight: 500;">
                      <p class="mb-2">Total</p>
                      <p class="mb-2">{{ getPrice(Cart::total()) }}</p>
                    </div>

                    <button type="button" class="btn btn-primary btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span>Checkout</span>
                        <span>$26.48</span>
                      </div>
                    </button>

                  </div>
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