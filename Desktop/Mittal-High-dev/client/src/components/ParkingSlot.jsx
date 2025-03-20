import axios from "axios";
import React, { useState, useEffect } from "react";

function ParkingSlot(props) { // Translated "ParkingSlot" to "EmplacementParking"
  const [emplacementsParking, setEmplacementsParking] = useState([]); // Translated "parkingSlot" to "emplacementsParking"

  const obtenirEmplacements = async () => { // Translated "slots" to "obtenirEmplacements"
    try {
      const res = await axios.post(`${process.env.REACT_APP_SERVER}/voiremplacementsparking`, { // Translated "/viewparking" to "/voiremplacementsparking"
        identifiantUtilisateur: JSON.parse(localStorage.getItem("qui")).nomUtilisateur, // Translated "userId" to "identifiantUtilisateur", "whom" to "qui", and "username" to "nomUtilisateur"
      });
      setEmplacementsParking(res.data);
    } catch (erreur) { // Translated "error" to "erreur"
      console.log(erreur);
    }
  };

  useEffect(() => {
    obtenirEmplacements();
  }, []);

  return (
    <div className="w-screen h-screen flex justify-center items-center">
      <div className="carte p-5 justify-center items-center flex-wrap"> {/* Translated "card" to "carte" */}
        <div>
          <h1 className="ml-2 text-lg my-2 font-bold">Emplacement de parking</h1> {/* Translated "Parking Slot" to "Emplacement de parking" */}
        </div>
        <div className="flex">
          {emplacementsParking.map((element, indice) => { // Translated "ele" to "element" and "index" to "indice"
            if (element.emplacement_parking === null) { // Translated "parking_slot" to "emplacement_parking"
              return (
                <div
                  key={indice + 1}
                  className="w-full h-full flex justify-center items-center"
                >
                  <h1 className="font-medium text-lg">Aucun emplacement de parking attribué</h1> {/* Translated "No parking slot alloted" to "Aucun emplacement de parking attribué" */}
                </div>
              );
            } else {
              return (
                <div key={indice + 1} className="p-5 border-2 m-2 rounded-md">
                  <p className="font-semibold text-xl">{element.emplacement_parking}</p>
                  <h1 className="text-gray-500">Numéro d'emplacement</h1> {/* Translated "Slot no" to "Numéro d'emplacement" */}
                </div>
              );
            }
            // console.log(element);
          })}
        </div>
      </div>
    </div>
  );
}

export default ParkingSlot; // Translated "ParkingSlot" to "EmplacementParking"