<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;

use App\Mail\welcomeFreelance;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Freelance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom',
        'prenom',
        'identifiant',
        'description',
        'experience',
        'langue',
        'diplome',
        'certificat',
        'site',
        'competences',
        'taux_journalier',
        'comptes',
        'sub_categorie',
        'localisation',
        'user_id',
        'category_id',
        'level',
        'solde',
        'realisations',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'level' => 'integer',
        'langue' =>
        AsArrayObject::class,
        'diplome' =>
        AsArrayObject::class,
        'certificat' =>
        AsArrayObject::class,
        'competences' =>
        AsArrayObject::class,
        'taux_journalier' => 'decimal:2',
        //'solde' => 'decimal:2',
        'comptes' =>
        AsArrayObject::class,
        'sub_categorie'
        => 'array',
        'localisation' =>
        AsArrayObject::class,
        'user_id' => 'string',
        'category_id' => 'integer',
        'realisations' =>
        AsArrayObject::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function getSolde()
    {

        return $this->solde;
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'freelance_id')
            ->withTimestamps();
    }


    public static function boot()
    {
        parent::boot();

        static::creating(function ($freelance) {

            // $freelance->user_id = auth()->id();
            $freelance->identifiant = 'FR' . date('YmdHms');
            $freelance->solde = 0;
        });


        static::created(function ($freelance) {
        });
    }

    public function scopeFilter($query, array $filters)
    {
        // 'search', 'category', 'sub_category', 'price', 'level', 'disponible'
        $query->when($filters['category'] ?? null, function ($query) use ($filters) {
            $query->whereHas('category', function ($q) use ($filters) {
                $q->where('id', $filters['category']);
            });
        })->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('nom', 'like', '%' . $search . '%')
                    ->orWhere('prenom', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        })
            ->when(!empty($filters['level']) && is_array($filters['level']), function ($query) use ($filters) {
                $query->whereIn('level', $filters['freelance_niveau']);
            })
            // ... Autres conditions de filtre ...

            ->when($filters['disponible'] ?? null, function ($query) use ($filters) {
                $query->whereHas('user', function ($q) use ($filters) {
                    $q->where('is_online', $filters['disponible']);
                });
            });
    }

    public static function getFilteredFreelances(Request $request, $perPage = 10)
    {
        return self::with('category')
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->filter($request->only('search', 'category', 'sub_category', 'price', 'level', 'disponible'))
            ->paginate($perPage)
            ->withQueryString()
            ->through(function ($freelance) {
                return [
                    'id' => $freelance->id,
                    'nom' => $freelance->nom,
                    'prenom' => $freelance->prenom,
                    'level' => $freelance->level,
                    'identifiant' => $freelance->identifiant,
                    'sub_categorie' => $freelance->subcategories(),
                    'like' => $freelance->isFavorite(),
                    'user' => $freelance->user ? $freelance->user->only('name', 'profile_photo_url', 'profile_photo_path') : null,
                    'category' => $freelance->category ? $freelance->category->only('name', 'id') : null,
                ];
            });
    }





    public function isFavorite()
    {
        return $this->favorites()
            ->where('user_id', auth()->id())
            ->exists();
    }

    /**
     * Renvoie un tableau de noms de sous-catégories basé sur les IDs dans sub_categorie.
     *
     * @return array
     */
    public function subcategories()
    {
        // Récupérez les IDs de sous-catégories du Freelance
        $subCategoryIds = $this->sub_categorie;

        // Vérifiez si $subCategoryIds est null ou vide
        if (is_null($subCategoryIds) || empty($subCategoryIds)) {
            return [];
        }

        // Chargez les sous-catégories correspondantes
        $relatedSubcategories = SubCategory::whereIn('id', $subCategoryIds)->get();

        return $relatedSubcategories;
    }
}
