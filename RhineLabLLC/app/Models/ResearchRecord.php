<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResearchRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_project_id',
        'division_id',
        'user_id',
        'record_code',
        'classification',
        'status',
        'recorded_at',
        'summary',
        'image_path',
        'file_path',       // TAMBAHKAN INI
        'thumbnail_path',  // TAMBAHKAN INI
    ];

    protected $casts = [
        'recorded_at' => 'date',
    ];

    /**
     * Relasi ke Proyek Riset.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(ResearchProject::class, 'research_project_id');
    }

    /**
     * Relasi ke Divisi.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    /**
     * Relasi ke User / Operatif / Scientist.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Dokumen Pendukung (Penyebab error RelationNotFoundException tadi).
     */
    public function documents(): HasMany
    {
        return $this->hasMany(ResearchDocument::class, 'research_record_id');
    }

    /**
     * Relasi ke Material Terhubung (Pivot Table).
     */
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'material_research_record')
                    ->withTimestamps();
    }
}