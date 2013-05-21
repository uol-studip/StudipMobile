<?

namespace Studip\Mobile;

require_once $GLOBALS['RELATIVE_PATH_RESOURCES'] . "/lib/ResourceObject.class.php";

class Resource
{
    static function getResources($course)
    {
        $resources = array();

        //for cycleDates
        foreach ($course->metadate->cycles as $cycle_date) {
            $metadate_id = $cycle_date->metadate_id;
            $termine = \CycleDataDB::getTermine($metadate_id);

            //filter the resources
            $resourcesForTermin = array();
            foreach ($termine as $termin) {
                if ($termin["resource_id"] != ""
                    && !in_array($termin["resource_id"], $resourcesForTermin)) {

                    //wenn resource_id gefunden in array packen
                    $resourcesForTermin[] = $termin["resource_id"];
                }
            }

            // all resources fot current cycle are
            // stored in $resourcesForTermin

            // for all resources fot the current date
            foreach ($resourcesForTermin as $resourceID) {
                $resObject = \ResourceObject::Factory($resourceID);
                $location = Resource::getLocationForResource($resObject);
                $resources[$metadate_id]["id"]          = $resourceID;
                $resources[$metadate_id]["name"]        = $resObject->getName();
                $resources[$metadate_id]["description"] = $resObject->getDescription();
                $resources[$metadate_id]["longitude"]   = $location["longitude"];
                $resources[$metadate_id]["latitude"]    = $location["latitude"];
            }
        }
        return $resources;
    }

    function getLocationForResource($resource)
    {
        if ($location = self::extractLocation($resource)) {
            return $location;
        }

        $parentID = $resource->getParentId();
        $parentObject = \ResourceObject::Factory($parentID);
        if ($parentObject->getId() == $parentObject->getRootId()) {
            return false;
        } else {
            //suche nach geoinfo am parent
            return Resource::getLocationForResource($parentObject);
        }
    }

      private static function getPropertyID()
      {
          return md5("geoLocation");
      }

    private function extractLocation($resource)
    {

        $query =
          "SELECT state ".
          "FROM resources_objects_properties ".
          "WHERE resource_id = ? ".
          "AND property_id = ?";

        $stmt = \DBManager::get()->prepare($query);
        $stmt->execute(array($resource->id, self::getPropertyID()));

        $location = $stmt->fetchColumn();
        if (!$location) {
            return false;
        }

        list($latitude, $longitude) = explode("-", $location);

        return compact("latitude", "longitude");
    }
}
