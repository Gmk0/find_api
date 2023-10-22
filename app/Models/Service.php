<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_numero',
        'title',
        'tag',
        'description',
        'basic_price',
        'basic_support',
        'basic_revision',
        'basic_delivery_time',
        'premium_price',
        'premium_support',
        'premium_revision',
        'premium_delivery_time',
        'extra_price',
        'extra_support',
        'extra_revision',
        'extra_delivery_time',
        'example',
        'files',
        'format',
        'need_service',
        'delivery_time_unit',
        'sub_category',
        'video_url',
        'view_count',
        'like',
        'is_publish',
        'freelance_id',
        'category_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tag' => 'array',
        'basic_price' => 'decimal:2',
        'sub_category' => 'array',
        'files' => 'array',
        'basic_support' => 'array',
        'premium_support' => 'array',
        'extra_support' => 'array',
        'premium_price' => 'decimal:2',
        'extra_price' => 'decimal:2',
        'view_count' => 'integer',
        'like' => 'integer',
        'freelance_id' => 'integer',
        'example'
        => AsArrayObject::class,
        'category_id' => 'integer',
    ];





    public function favoris(): BelongsTo
    {
        return $this->belongsTo(Favoris::class);
    }

    public function freelance(): BelongsTo
    {
        return $this->belongsTo(Freelance::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }


    public function isFavorite()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->exists();
    }




    public function averageFeedback()
    {
        // Récupérer les commandes liées à ce service
        $orders = $this->orders;

        // Récupérer les feedbacks associés à ces commandes
        $feedbacks = FeedbackService::whereIn('order_id', $orders->pluck('id'))->exists();

        if ($feedbacks) {
            $feedback2 = FeedbackService::whereIn('order_id', $orders->pluck('id'))->get();
            $averageFeedback = $feedback2->avg('satisfaction');

            $averageFeedbackArrondi = round($averageFeedback, 1);

            return $averageFeedbackArrondi;
        } else {
            return 0;
        }
        // Calculer la moyenne des feedbacks

    }


    public function orderCount()
    {
        // Récupérer le nombre de commandes pour ce service
        $orderCount = $this->orders->count();

        return $orderCount;
    }
    public function price()
    {

        return $this->basic_price . "$";
    }

    public function scopeFilter($query, array $filters)
    {
        // 'search', 'category', 'sub_category', 'price', 'level', 'disponible'
        $query->when($filters['sub_category'] ?? null, function ($query) use ($filters) {
            $query->where('sub_category', 'like', '%"' . $filters['sub_category'] . '"%');
        })->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('sub_category', 'like', '%' . $search . '%')
                    ->orWhere('tag', 'like', '%' . $search . '%');
            });
        })
            ->when(!empty($filters['level']), function ($query) use ($filters) {
                $query->whereHas('freelance', function ($q) use ($filters) {
                    $q->where('level', $filters['level']);
                });
            })->when(!empty($filters['price']), function ($query) use ($filters) {
                $query->whereBetween('basic_price', [10, $filters['price']]);
            })->when(!empty($filters['tag']), function ($query) use ($filters) {
                $query->where('tag', 'like', '%' . $filters['tag'] . '%');
            })->when(!empty($filters['deliveryTime']), function ($query) use ($filters) {
                list($min, $max) = explode('-', $filters['deliveryTime']);


                $query->whereBetween('basic_delivery_time', [$min, $max]);
            })->when(!empty($filters['orderBy']), function ($query) use ($filters) {

                [$field, $direction] = explode('-', $filters['orderBy']);

                // Si les valeurs sont "populaire" ou "nouveau", ajustez le champ et la direction en conséquence
                if ($field === 'populaire') {
                    $query->withCount('orders') // Assurez-vous que votre relation s'appelle "orders"
                        ->orderBy('orders_count', 'desc'); // Triez par le nombre de commandes
                } else {
                    $query->orderBy($field, $direction);
                }
            });
    }

    public function subcategories()
    {
        // Récupérez les IDs de sous-catégories du Freelance
        $subCategoryIds = $this->sub_category;

        // Vérifiez si $subCategoryIds est null ou vide
        if (is_null($subCategoryIds) || empty($subCategoryIds)) {
            return [];
        }

        // Chargez les sous-catégories correspondantes
        $relatedSubcategories = SubCategory::whereIn('id', $subCategoryIds)->get();

        return $relatedSubcategories;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            // $service->service_numero = 'SV' . date('YmdHms');
            //$service->freelance_id = auth()->user()->freelance->id;
        });
    }
}
