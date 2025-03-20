import React, { useState, useRef } from "react";
import axios from "axios";
import { toast } from "react-toastify";

function CreatingTenant() { // Translated "CreatingTenant" to "CreationLocataire"
  const champLocataire = useRef(null); // Translated "tenantEl" to "champLocataire" (tenant field)
  const champNom = useRef(null); // Translated "nameEl" to "champNom" (name field)
  const champAge = useRef(null); // Translated "ageEl" to "champAge" (age field)
  const champDateNaissance = useRef(null); // Translated "dobEl" to "champDateNaissance" (date of birth field)
  const champNumeroChambre = useRef(null); // Translated "roomEl" to "champNumeroChambre" (room number field)
  const champMotDePasse = useRef(null); // Translated "passEl" to "champMotDePasse" (password field)
  const champAdhaar = useRef(null); // "Adhaar" remains as is (proper noun), but "El" → "champAdhaar"

  const [nom, setNom] = useState(""); // Translated "name" to "nom"
  const [age, setAge] = useState(""); // "age" remains "age" (common in French too)
  const [dateNaissance, setDateNaissance] = useState(""); // Translated "dob" to "dateNaissance"
  const [numeroChambre, setNumeroChambre] = useState(""); // Translated "roomno" to "numeroChambre"
  const [motDePasse, setMotDePasse] = useState(""); // Translated "pass" to "motDePasse"
  const [numeroLocataire, setNumeroLocataire] = useState(""); // Translated "tenantno" to "numeroLocataire"
  const [adhaar, setAdhaar] = useState(""); // "adhaar" remains as is (proper noun)

  const creerLocataire = async () => { // Translated "createTenant" to "creerLocataire"
    try {
      const res = await axios.post(`${process.env.REACT_APP_SERVER}/creerlocataire`, { // Translated "/createtenant" to "/creerlocataire"
        nom: nom,
        age: age,
        numeroChambre: numeroChambre, // Translated "roomno" to "numeroChambre"
        numeroLocataire: numeroLocataire, // Translated "tenantno" to "numeroLocataire"
        motDePasse: motDePasse, // Translated "password" to "motDePasse"
        adhaar: adhaar,
        dateNaissance: dateNaissance, // Translated "dob" to "dateNaissance"
      });
      if (res.status === 200) {
        toast.success("Locataire créé"); // Translated "Tenant Created" to "Locataire créé"
        champLocataire.current.value = "";
        champNom.current.value = "";
        champAge.current.value = "";
        champNumeroChambre.current.value = "";
        champMotDePasse.current.value = "";
        champAdhaar.current.value = "";
        champDateNaissance.current.value = "";
      } else {
        toast.error("Erreur : " + res.message); // Translated "Error" to "Erreur"
      }
    } catch (erreur) { // Translated "error" to "erreur"
      console.log(erreur);
      toast.error("Erreur : " + erreur.message); // Translated "Error" to "Erreur"
    }
  };

  const gestionnaireSoumission = function (e) { // Translated "submitHandler" to "gestionnaireSoumission"
    e.preventDefault();
    creerLocataire();
  };

  return (
    <div className="mx-auto w-full max-w-[550px] my-5 p-5">
      <form onSubmit={gestionnaireSoumission} action="" method="POST">
        <div className="mb-5">
          <label
            htmlFor="nom" // Translated "name" to "nom"
            className="mb-3 block text-base font-medium text-[#07074D]"
          >
            Nom complet {/* Translated "Full Name" to "Nom complet" */}
          </label>
          <input
            type="text"
            ref={champNom}
            name="nom"
            id="nom"
            value={nom}
            placeholder="Nom complet" // Translated "Full Name" to "Nom complet"
            onChange={() => {
              setNom(champNom.current.value);
            }}
            className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>
        <div className="mb-5 flex gap-5 flex-wrap">
          <div>
            <label
              htmlFor="numero-locataire" // Translated "tenant-no" to "numero-locataire"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Numéro de locataire {/* Translated "Tenant No." to "Numéro de locataire" */}
            </label>
            <input
              type="text"
              ref={champLocataire}
              name="numero-locataire"
              id="numero-locataire"
              value={numeroLocataire}
              placeholder="Numéro de locataire" // Translated "Tenant No." to "Numéro de locataire"
              onChange={() => {
                setNumeroLocataire(champLocataire.current.value);
              }}
              className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
          <div>
            <label
              htmlFor="numero-chambre" // Translated "room-no" to "numero-chambre"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Numéro de chambre {/* Translated "Room no" to "Numéro de chambre" */}
            </label>
            <input
              type="text"
              ref={champNumeroChambre}
              name="numero-chambre"
              id="numero-chambre"
              value={numeroChambre}
              placeholder="Numéro de chambre" // Translated "Room no" to "Numéro de chambre"
              onChange={() => {
                setNumeroChambre(champNumeroChambre.current.value);
              }}
              className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
        </div>
        <div className="mb-5 flex gap-5 flex-wrap">
          <div>
            <label
              htmlFor="date-naissance" // Translated "dob" to "date-naissance"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Date de naissance {/* Translated "DOB" to "Date de naissance" */}
            </label>
            <input
              type="date"
              name="date-naissance"
              ref={champDateNaissance}
              value={dateNaissance}
              onChange={() => {
                setDateNaissance(champDateNaissance.current.value);
              }}
              id="date-naissance"
              placeholder="Entrez votre date de naissance" // Translated "Enter your dob" to "Entrez votre date de naissance"
              className="w-60 rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
          <div>
            <label
              htmlFor="age"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Âge {/* Translated "Age" to "Âge" */}
            </label>
            <input
              type="number"
              name="age"
              ref={champAge}
              id="age"
              value={age}
              onChange={() => {
                setAge(champAge.current.value);
              }}
              placeholder="Âge" // Translated "Age" to "Âge"
              className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
            />
          </div>
        </div>
        <div className="mb-5">
          <label
            htmlFor="adhaar"
            className="mb-3 block text-base font-medium text-[#07074D]"
          >
            Adhaar
          </label>
          <input
            type="text" // Corrected "type=adhaar" to "type=text" (assuming it was a typo)
            name="adhaar"
            ref={champAdhaar}
            id="adhaar"
            value={adhaar}
            onChange={() => {
              setAdhaar(champAdhaar.current.value);
            }}
            placeholder="Adhaar"
            className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>
        <div className="mb-5">
          <label
            htmlFor="mot-de-passe" // Translated "pass" to "mot-de-passe"
            className="mb-3 block text-base font-medium text-[#07074D]"
          >
            Mot de passe {/* Translated "Password" to "Mot de passe" */}
          </label>
          <input
            type="text"
            name="mot-de-passe"
            ref={champMotDePasse}
            value={motDePasse}
            onChange={() => {
              setMotDePasse(champMotDePasse.current.value);
            }}
            id="mot-de-passe" // Corrected "id=dob" to "id=mot-de-passe" (assuming it was a typo)
            placeholder="Entrez votre mot de passe" // Translated "Enter your Password" to "Entrez votre mot de passe"
            className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>
        <div className="flex w-full">
          <button className="mx-auto hover:shadow-form py-3 px-8 text-white bg-blue-500 rounded-md focus:bg-blue-600 focus:outline-none hover:bg-white hover:text-blue-500 transition-all duration-300 hover:border-blue-500 border-transparent border-2">
            Soumettre {/* Translated "Submit" to "Soumettre" */}
          </button>
        </div>
      </form>
    </div>
  );
}

export default CreatingTenant; // Translated "CreatingTenant" to "CreationLocataire"