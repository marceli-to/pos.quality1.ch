<?php
namespace App\Exports\Sheets;
use App\Models\Vote;
use App\Models\Building;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VotesByBuildingSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize, WithStyles
{
  private $building;

  public function __construct(Building $building)
  {
    $this->building = $building;
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $votes = Vote::with('voter')->where('building_id', '=', $this->building->id)->get();
    $data = [];
    foreach($votes as $v)
    {
      $data[] = [
        'Datum' => $v->dateExport,
        'IP Adresse' => $v->voter->ip_address,
        'Hash' => $v->voter->hash
      ];
    }
    return collect($data);
  }

  public function headings(): array
  {
    return [
      'Datum',
      'IP Adresse',
      'Hash'
    ];
  }

  public function title(): string
  {
    return $this->building->title;
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true]],
    ];
  }

}