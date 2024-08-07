<?php

namespace App\Policies;

use App\Models\MedicineCategories;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MedicineCategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MedicineCategories $medicineCategories): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MedicineCategories $medicineCategories): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MedicineCategories $medicineCategories): bool
    {
        //
        return $user->role === "apoteker";
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MedicineCategories $medicineCategories): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MedicineCategories $medicineCategories): bool
    {
        //
    }
}
