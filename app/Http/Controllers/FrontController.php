<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\House;
use App\Models\Interest;
use App\Services\HouseService;
use App\Services\MortgageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function __construct(
        protected HouseService $houseService,
        protected MortgageService $mortgageService
    ) {}

    public function index(): View
    {
        $data = $this->houseService->getCategoriesAndCities();

        return view('pages.front.home.index', $data);
    }

    public function search(Request $request): View
    {
        $data = $this->houseService->searchHouses($request->all());

        return view('front.search', $data);
    }

    public function details(House $house): View
    {
        $houseDetails = $this->houseService->getHouseDetails($house);

        return view('front.details', $houseDetails);
    }

    public function category(): View
    {
        $category = $this->houseService->getCategoriesAndCities();

        return view('pages.front.category.index', $category);
    }

    public function categoryDetails(Category $category): View
    {
        $category->load('houses');

        return view('front.category', $category);
    }

    public function interest(Interest $interest): View
    {
        return view('customer.mortgages.request-mortgage', compact('interest'));
    }

    public function requestInterest(Request $request): RedirectResponse
    {
        $this->mortgageService->handleInterestRequest($request);

        return redirect()->route('front.request_success');
    }

    public function requestSuccess(): RedirectResponse|View
    {
        $interest = $this->mortgageService->getInterestFromSession();
        if (! $interest) {
            return redirect()->route('front.index')->with('error', 'Invalid request. Please try again.');
        }

        return view('customer.mortgages.success-request', compact('interest'));
    }
}
