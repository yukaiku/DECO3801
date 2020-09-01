using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class NounLinkage : MonoBehaviour
{
    public Text nounText;

    private void checkNounText()
    {
        if (nounText == null)
        {
            NounLinkage component = this.gameObject.GetComponent<NounLinkage>();
            Destroy(component);

            Debug.Log(string.Format("No corresponding noun text : the component won't work"));
        }
    }

    private void clickNounObject()
    {
        if (nounText.gameObject.activeSelf)
        {
            // save player score here
            PlayerData.saveScore(PlayerData.getScore() + 1);

            nounText.gameObject.SetActive(false);

            Debug.Log(string.Format("Disable noun '{0}' text '{1}' successful",
                this.gameObject.name, nounText.text));
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
        checkNounText();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
