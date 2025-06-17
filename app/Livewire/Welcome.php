<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Component;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;
    public $labelMonths;
    public $datasetProducts;
    public $barData;
    public $pieData;
    public $lineData;
    public string $search = '';

    public string $title = "Dashboard";
    public string $url = "/dashboard";

    public bool $drawer = false;

    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($id): void
    {
        $this->warning("Will delete #$id", 'It is fake.', position: 'toast-bottom');
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'w-1'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'w-64'],
            ['key' => 'age', 'label' => 'Age', 'class' => 'w-20'],
            ['key' => 'email', 'label' => 'E-mail', 'sortable' => false],
        ];
    }

    /**
     * For demo purpose, this is a static collection.
     *
     * On real projects you do it with Eloquent collections.
     * Please, refer to maryUI docs to see the eloquent examples.
     */
    public function users(): Collection
    {
        return collect([
            ['id' => 1, 'name' => 'Mary', 'email' => 'mary@mary-ui.com', 'age' => 23],
            ['id' => 2, 'name' => 'Giovanna', 'email' => 'giovanna@mary-ui.com', 'age' => 7],
            ['id' => 3, 'name' => 'Marina', 'email' => 'marina@mary-ui.com', 'age' => 5],
        ])
            ->sortBy([[...array_values($this->sortBy)]])
            ->when($this->search, function (Collection $collection) {
                return $collection->filter(fn(array $item) => str($item['name'])->contains($this->search, true));
            });
    }

    public function mount()
    {

        $this->labelMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $this->datasetProducts = [
            [
                'label' => 'TV',
                'data' => [120, 140, 100, 130, 150, 170, 0, 0, 0, 0, 0, 0],
                'borderColor' => 'rgba(255, 99, 132, 1)',
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                'fill' => false,
                'type' => 'line',
                'tension' => 0.3,
            ],
            [
                'label' => 'Refrigerator',
                'data' => [100, 90, 110, 105, 115, 125, 0, 0, 0, 0, 0, 0],
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'fill' => false,
                'type' => 'line',
                'tension' => 0.3,
            ],
            [
                'label' => 'Washing Machine',
                'data' => [60, 70, 65, 75, 80, 90, 0, 0, 0, 0, 0, 0],
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'fill' => false,
                'type' => 'line',
                'tension' => 0.3,
            ]
        ];

        $this->barData = [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr'],
            'data' => [10, 20, 30, 25],
        ];

        $this->pieData = [
            'labels' => ['A', 'B', 'C'],
            'data' => [40, 30, 30],
        ];

        $this->lineData = [
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            'data' => [5, 15, 10, 20],
        ];
    }

    public function render()
    {

        return view('livewire.welcome');
    }
}
