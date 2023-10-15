<!-- component -->
<div class="overflow-hidden mb-4 w-full">
    <div class="px-6 py-4 mb-2 mt-4 mb-8" id="sidebar">
        <div class="{{ request()->is('admin/dashboard') ? 'bg-gray-300' : ''}} flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" style="border-left: 4px solid #e2624b !important;">
            <a href="{{Route('home')}}" class="text-md">Home</a>
        </div>
        <div class="{{ request()->is('admin/products') ? 'bg-gray-300' : ''}} flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" style="border-left: 4px solid #e2624b !important;">
            <a href="{{Route('admin.products.index')}}" class="text-md">Products</a>
        </div>
        <div class="{{ request()->is('admin/tags') ? 'bg-gray-300' : ''}} flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" style="border-left: 4px solid #e2624b !important;">
            <a href="{{Route('admin.tags.index')}}" class="text-md">Tags</a>
        </div>
    </div>
</div>
