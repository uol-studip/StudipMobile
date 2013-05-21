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

    private function extractLocation($resource)
    {

        return array("latitude" => 52.27, "longitude" => 8.05);

        $plainProp = $resource->getPlainProperties(false);
        $regex     = "#(?:geoLocation:\s)([0-9\.]+)-([0-9\.]+)#";
        $geoinfo   = array();

        if (preg_match_all($regex, $plainProp, $geoinfo) > 0) {
            //pattern gefunden
            $location["longitude"] = $geoinfo[2][0];
            $location["latitude"]  = $geoinfo[1][0];
            return $location;
        }

        return false;
    }
}
