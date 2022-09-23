<?php

namespace App\Imports;

use App\Models\Shift;
use App\Models\Employer;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShiftsImport implements ToModel, WithHeadingRow
{


    /**
     * CSV Data Format:
     * dataset = [
     * 'date',
     * 'employee',
     * 'employer',
     * 'hours',
     * 'rate_per_hour',
     * 'taxable',
     * 'status',
     * 'shift_type',
     * 'paid_at'
     * ]
     */


    /**
     * Validating dataset:
     * Field "Date" is required and has to be a valid date format ex."7/24/2022".
     * Field "Employee" is required.
     * Field "Employer" is required.
     * Field "Hours" is required and has to be numeric.
     * Field "Rate Per Hour" is required.
     * Field "Taxable" is required and has to be either "Yes" or "No".
     * Field "Status" is required and has to be either "Complete", "Pending".
     * Field "Shift Type" is required and has to be either "Day" or "Night".
     * Field "Paid At" is required and has to be a valid date format ex."7/24/2022 22:30".
     */
    public function rules(): array
    {
        // 'taxable'       => 'required|in:Yes,No',
        // 'status'        => 'required|in:Complete,Pending,Processing,Failed',
        // 'shift_type'    => 'required|in:Day,Night,Holiday',
        return [
            'date'          => 'required|date_format:m/d/Y',
            'employee'      => 'required',
            'employer'      => 'required',
            'hours'         => 'required|numeric',
            'rate_per_hour' => 'required',
            'taxable'       => 'required',
            'status'        => 'required',
            'shift_type'    => 'required',
            'paid_at'       => 'required',
        ];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /**
         * Checking:
         * If Employee or Employer don't exist in the database
         * then create them with the given name in the row
         * else skip the given user.
         *
         * This stops duplication in the database which helps with performance.
         */
        $employee = User::firstOrCreate(['name'     => $row['employee']]);
        $employer = Employer::firstOrCreate(['company' => $row['employer']]);

        // Get UUID's of employee and employer
        $employee_uuid = $employee->id;
        $employer_uuid = $employer->id;

        // Changing it to time with a new form so it's able to be inserted into SQL
        $paid_at = strtotime($row['paid_at']);

        /**
         *
         * Create a new Shift in the database table
         * with all the required rows.
         *
         * Included:
         * IDs for Employee and Employeer
         * Fixed dateTime since SQL doesn't read AM or PM
         *
         */

        return new Shift([
            'date'          => $row['date'],
            'user_id'       => $employee_uuid,
            'employer_id'  => $employer_uuid,
            'hours'         => $row['hours'],
            'avg_hour'      => $row['rate_per_hour'],
            'taxable'       => $row['taxable'],
            'status'        => $row['status'],
            'shift_type'    => $row['shift_type'],
            'paid_at'       => date("Y-m-d H:i:s", $paid_at),
        ]);
    }
}
