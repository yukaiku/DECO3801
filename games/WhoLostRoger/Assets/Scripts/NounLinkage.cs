using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class NounLinkage : MonoBehaviour
{
    [Tooltip("The corresponding noun text")]
    public Text nounText;
    [Tooltip("assign to the noun text panel")]
    public IsResult resultTrigger;

    private void isArgsNull()
    {
        if (nounText == null || resultTrigger == null)
        {
            NounLinkage component = this.gameObject.GetComponent<NounLinkage>();
            Destroy(component);

            Debug.Log(string.Format("No corresponding noun text : the component won't work"));
        }

        nounText.GetComponent<Button>().onClick.AddListener(() => {
            global.selectedNoun = nounText.name;    
            Debug.Log("Current Select noun:"+nounText.name);
            if(nounText.name.Equals(global.selectedNounObject)){
                // save player score here
                PlayerData.saveScore(PlayerData.getScore() + 1);

                nounText.gameObject.SetActive(false);
                Debug.Log(string.Format("Disable noun '{0}' text '{1}' successful",
                    this.gameObject.name, nounText.text));

                nounText.transform.position =  new Vector3(-5000, -5000,0);
                this.transform.position =  new Vector3(-5000, -5000,0);
            }
        });
    }

    private void clickNounObject()
    {
        if (nounText.gameObject.activeSelf)
        {   global.selectedNounObject = nounText.name;
            Debug.Log("Current Select noun Object:" + nounText.name);
            if(nounText.name.Equals(global.selectedNoun)){
               // save player score here
               PlayerData.saveScore(PlayerData.getScore() + 1);

               nounText.gameObject.SetActive(false);
               Debug.Log(string.Format("Disable noun '{0}' text '{1}' successful",
                   this.gameObject.name, nounText.text));

                nounText.transform.position =  new Vector3(-5000, -5000,0);
                this.transform.position =  new Vector3(-5000, -5000,0);
            }
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        clickNounObject();
    }

    // Start is called before the first frame update
    void Start()
    {
        isArgsNull();
    }

    // Update is called once per frame
    void Update()
    {
       resultTrigger.isAllNounClicked(); 
    }
}
