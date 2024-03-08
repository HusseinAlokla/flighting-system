<?php

namespace App\Exports;
use App\Models\User; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Select only the data you want to export, exclude sensitive information
        return User::all()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at ? $user->email_verified_at->toDateTimeString() : null,
                'deleted_at' => $user->deleted_at ? $user->deleted_at->toDateTimeString() : null,
                'created_at' => $user->created_at ? $user->created_at->toDateTimeString() : null,
                'updated_at' => $user->updated_at ? $user->updated_at->toDateTimeString() : null,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the headings for your Excel sheet.
        return [
            "ID", 
            "Name", 
            "Email", 
            "Email Verified At", 
            "Deleted At", 
            "Created At", 
            "Updated At"
        ];
    }
}
