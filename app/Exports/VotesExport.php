<?php
namespace App\Exports;
use App\Models\Vote;
use App\Models\Building;
use App\Exports\Sheets\VotesByBuildingSheet;
use App\Exports\Sheets\VotesSummarySheet; 
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class VotesExport implements WithMultipleSheets
{
  /**
   * @return array
   */
  public function sheets(): array
  {
    $sheets = []; 

    // Summary sheet
    $sheets[] = new VotesSummarySheet();

    // Create a sheet per building
    $buildings = Building::with('votes')->orderBy('title')->get();
    foreach($buildings as $building)
    {
      if ($building->votes->count() > 0)
      {
        $sheets[] = new VotesByBuildingSheet($building);
      }
    }
    return $sheets;
  }

}
