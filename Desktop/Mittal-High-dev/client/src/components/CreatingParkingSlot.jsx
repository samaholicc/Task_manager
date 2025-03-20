import axios from "axios";
import React, { useState, useRef } from "react";
import { toast } from "react-toastify";

function CreatingParkingSlot() { // Translated "CreatingParkingSlot" to "CreationEmplacementParking"
  const champNumeroChambre = useRef(null); // Translated "roomEl" to "champNumeroChambre" (room number field)
  const champNumeroEmplacement = useRef(null); // Translated "slotNoEl" to "champNumeroEmplacement" (slot number field)
  const [numeroChambre, setNumeroChambre] = useState(""); // Translated "roomNo" to "numeroChambre"
  const [numeroEmplacement, setNumeroEmplacement] = useState(""); // Translated "slotNo" to "numeroEmplacement"

  const creerEmplacement = async () => { // Translated "createSlot" to "creerEmplacement"
    try {
      const res = await axios.post(`${process.env.REACT_APP_SERVER}/reserveremplacement`, { // Translated "/bookslot" to "/reserveremplacement"
        numeroChambre: numeroChambre, // Translated "roomNo" to "numeroChambre"
        numeroEmplacement: numeroEmplacement, // Translated "slotNo" to "numeroEmplacement"
      });
      if (res.status === 200) {
        champNumeroChambre.current.value = "";
        champNumeroEmplacement.current.value = "";
        toast.success("Emplacement de parking attribué"); // Translated "Parking slot alloted" to "Emplacement de parking attribué"
      }
    } catch (erreur) { // Translated "error" to "erreur"
      console.log(erreur);
      toast.error(erreur.message);
    }
  };

  const gestionnaireSoumission = function (e) { // Translated "submitHandler" to "gestionnaireSoumission"
    e.preventDefault();
    creerEmplacement();
  };

  return (
    <div className="flex items-center justify-center h-screen w-screen">
      <div className="conteneur mx-auto"> {/* Translated "container" to "conteneur" */}
        <div className="max-w-md mx-auto my-5 p-5 carte"> {/* Translated "card" to "carte" */}
          <div className="m-7">
            <form onSubmit={gestionnaireSoumission} action="" method="POST" id="formulaire"> {/* Translated "form" to "formulaire" */}
              <div>
                <h1 className="text-center font-bold text-gray-600 my-2">
                  Emplacement de parking {/* Translated "Parking Slot" to "Emplacement de parking" */}
                </h1>
              </div>
              <div className="mb-6">
                <label
                  htmlFor="numeroChambre" // Translated "roomNo" to "numeroChambre"
                  className="block mb-2 text-base text-gray-600 "
                >
                  Numéro de chambre {/* Translated "Room No" to "Numéro de chambre" */}
                </label>
                <input
                  type="text"
                  ref={champNumeroChambre}
                  value={numeroChambre}
                  onChange={() => {
                    setNumeroChambre(champNumeroChambre.current.value);
                  }}
                  name="numero-chambre" // Translated "Room no" to "numero-chambre"
                  id="numero-chambre"
                  placeholder="Entrez votre numéro de chambre" // Translated "Enter your Room no" to "Entrez votre numéro de chambre"
                  required
                  className="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 bg-[#eeeff1]"
                />
              </div>

              <div className="mb-6">
                <label
                  htmlFor="numero-emplacement" // Translated "pno" to "numero-emplacement"
                  className="text-base mb-2 block text-gray-600 "
                >
                  Numéro de parking {/* Translated "Parking Number" to "Numéro de parking" */}
                </label>
                <input
                  type="text"
                  ref={champNumeroEmplacement}
                  value={numeroEmplacement}
                  onChange={() => {
                    setNumeroEmplacement(champNumeroEmplacement.current.value);
                  }}
                  name="numero-emplacement"
                  id="numero-emplacement"
                  placeholder="Entrez le numéro de l'emplacement de parking" // Translated "Enter Parking slot number" to "Entrez le numéro de l'emplacement de parking"
                  required
                  className="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 bg-[#eeeff1]"
                />
              </div>

              <div className="mb-6">
                <button
                  type="submit"
                  className="w-full px-3 py-3 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none hover:bg-white hover:text-blue-500 transition-all duration-300 hover:border-blue-500 border-transparent border-2"
                >
                  Réserver l'emplacement {/* Translated "Book slot" to "Réserver l'emplacement" */}
                </button>
              </div>
              <p
                className="text-base text-center text-gray-400"
                id="resultat" // Translated "result" to "resultat"
              ></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}

export default CreatingParkingSlot; // Translated "CreatingParkingSlot" to "CreationEmplacementParking"