using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class IsResult : MonoBehaviour
{
    public GameObject nounPanel;

    private void checkNounPanel()
    {
        if (nounPanel == null)
        {
            IsResult component = this.gameObject.GetComponent<IsResult>();
            Destroy(component);

            Debug.Log(string.Format("Null noun panel assigned and the component won't work"));
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    // Start is called before the first frame update
    void Start()
    {
        checkNounPanel();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
