@if ($width === 'col-lg-6')
    <div class="{{ $width }}">
        <div class="d-flex align-items-center">
            <img class="flex-shrink-0 img-fluid rounded" src='{{ asset("storage/menu-images/$menu[image]") }}'
                alt="" style="width: 80px;">
            <div class="w-100 d-flex flex-column text-start ps-4">
                <h5 class="d-flex justify-content-between border-bottom pb-2">
                    <span>{{ $menu['name'] }}</span>
                    <span class="text-primary">{{ $menu['price'] }}</span>
                </h5>
                <h5 class="d-flex justify-content-between align-items-center">
                    <small class="fst-italic"
                        style="font-size:14px !important;font-weight:400 !important">{{ $menu['description'] }}</small>
                    <button class="btn btn-sm btn-primary addBtn" data-id="{{ $menu['id'] }}"
                        data-name="{{ $menu['name'] }}" data-image="{{ asset("storage/$menu[image]") }}"
                        data-price="{{ $menu['price'] }}" data-description="{{ $menu['description'] }}">Add</button>
                </h5>
            </div>
        </div>
    </div>
@else
    <div class="{{ $width }}">
        <div class="d-flex align-items-center">
            <img class="flex-shrink-0 img-fluid rounded" src='{{ asset("storage/menu-images/$menu[image]") }}'
                alt="" style="width: 80px;">
            <div class="w-100 d-flex flex-column text-start ps-4">
                <h5 class="d-flex justify-content-between border-bottom pb-2">
                    <span>{{ $menu['name'] }}</span>
                    <span class="text-primary">{{ $menu['price'] }}</span>
                </h5>
                <h5 class="d-flex justify-content-between align-items-center">
                    <small class="fst-italic"
                        style="font-size:14px !important;font-weight:400 !important">{{ $menu['description'] }}</small>
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-primary decreaseBtn" data-id="{{ $menu['id'] }}">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="btn btn-sm btn-outline-secondary quantity"></span>
                        <button class="btn btn-sm btn-primary increaseBtn" data-id="{{ $menu['id'] }}">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </h5>
            </div>
        </div>
    </div>
@endif
