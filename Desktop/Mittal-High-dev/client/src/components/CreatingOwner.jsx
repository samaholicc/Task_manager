import React, { useState, useRef } from "react";
import axios from "axios";
import { toast } from "react-toastify";

function CreatingOwner() { // Translated "CreatingUser" to "CreationUtilisateur"
  const champNom = useRef(null); // Translated "nameEl" to "champNom" (name field)
  const champAge = useRef(null); // Translated "ageEl" to "champAge" (age field)
  const champDateNaissance = useRef(null); // Translated "dobEl" to "champDateNaissance" (date of birth field)
  const champStatutAccord = useRef(null); // Translated "aggreeEl" to "champStatutAccord" (agreement status field)
  const champProprietaire = useRef(null); // Translated "ownerEl" to "champProprietaire" (owner field)
  const champNumeroChambre = useRef(null); // Translated "roomEl" to "champNumeroChambre" (room number field)
  const champMotDePasse = useRef(null); // Translated "passEl" to "champMotDePasse" (password field)

  const [nom, setNom] = useState(""); // Translated "name" to "nom"
  const [age, setAge] = useState(""); // "age" remains "age" (common in French too)
  const [dateNaissance, setDateNaissance] = useState(""); // Translated "dob" to "dateNaissance" (date of birth)
  const [idProprietaire, setIdProprietaire] = useState(""); // Translated "ownerId" to "idProprietaire"
  const [numeroChambre, setNumeroChambre] = useState(""); // Translated "roomno" to "numeroChambre"
  const [motDePasse, setMotDePasse] = useState(""); // Translated "pass" to "motDePasse"
  const [statutAccord, setStatutAccord] = useState(""); // Translated "aggrementStatus" to "statutAccord"

 
    const post = async () => {
      try {
        const payload = {
          nom: nom,
          age: age,
          idProprietaire: idProprietaire,
          numeroChambre: numeroChambre,
          motDePasse: motDePasse,
          statutAccord: statutAccord,
          dateNaissance: dateNaissance,
        };
        console.log('Payload sent:', payload);
        const res = await axios.post(`${process.env.REACT_APP_SERVER}/createowner`, payload);
        console.log('Response received:', res);
        if (res.status === 200) {
          console.log('Success: Showing toast'); // Add this
          champNom.current.value = "";
          champAge.current.value = "";
          champDateNaissance.current.value = "";
          champProprietaire.current.value = "";
          champStatutAccord.current.value = "";
          champMotDePasse.current.value = "";
          champNumeroChambre.current.value = "";
          toast.success("Propriétaire créé : " + nom);
        } else {
          console.log('Non-200 status:', res.status, res.data);
          toast.error(res.data.message || res.message || "Erreur inattendue");
        }
      } catch (erreur) {
        console.log('Error caught:', erreur);
        console.log('Error response:', erreur.response);
        const errorMessage = erreur.response?.data?.message || erreur.message;
        console.log('Error: Showing toast with message:', errorMessage); // Add this
        toast.error(errorMessage);
      }
    };
  
  const submitHandler = function (e) { // Translated "submitHandler" to "gestionnaireSoumission"
    e.preventDefault();
    console.log('Form submitted, calling poster'); // Log when form submission starts
    post();
  };

  return (
    <div className="mx-auto w-full max-w-[550px] my-5 p-5">
      <form onSubmit={submitHandler} action="" method="POST">
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
              htmlFor="id-proprietaire" // Translated "owner-id" to "id-proprietaire"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Identifiant Propriétaire {/* Translated "Owner Id" to "Identifiant Propriétaire" */}
            </label>
            <input
              type="text"
              ref={champProprietaire}
              name="id-proprietaire"
              id="id-proprietaire"
              value={idProprietaire}
              placeholder="Identifiant Propriétaire" // Translated "Owner Id" to "Identifiant Propriétaire"
              onChange={() => {
                setIdProprietaire(champProprietaire.current.value);
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
              htmlFor="statut-accord" // Translated "aggrementStatus" to "statut-accord"
              className="mb-3 block text-base font-medium text-[#07074D]"
            >
              Statut de l'accord {/* Translated "Agreement Status" to "Statut de l'accord" */}
            </label>
            <input
              type="text"
              ref={champStatutAccord}
              name="statut-accord"
              id="statut-accord"
              value={statutAccord}
              placeholder="[Oui / Non]" // Translated "[Yes / no]" to "[Oui / Non]"
              onChange={() => {
                setStatutAccord(champStatutAccord.current.value);
              }}
              className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
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
            id="mot-de-passe"
            placeholder="Entrez votre mot de passe" // Translated "Enter your Password" to "Entrez votre mot de passe"
            className="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
          />
        </div>
        <div className="mb-5">
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

export default CreatingOwner; 